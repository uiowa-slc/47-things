'use strict';

import path from 'path';
import gulp from 'gulp';
import del from 'del';
import browserSync from 'browser-sync';
// import swPrecache from 'sw-precache';
import autoprefixer from 'autoprefixer';
import cssnano from 'cssnano';
import gulpLoadPlugins from 'gulp-load-plugins';


// import {output as pagespeed} from 'psi';
import pkg from './package.json';

const $ = gulpLoadPlugins();
const reload = browserSync.reload;



// Lint JavaScript
function lint(){
  return gulp.src('./themes/47-things/scripts/**/*.js')
    .pipe($.eslint())
    .pipe($.eslint.format())
    .pipe($.if(!browserSync.active, $.eslint.failOnError()));
}


// Optimize images
function images(){
  return gulp.src('./themes/47-things/src/images/**/*')
    .pipe($.imagemin({
      progressive: true,
      interlaced: true
    }))
    .pipe(gulp.dest('./themes/47-things/dist/images'))
    .pipe($.size({title: './themes/47-things/dist/images'}));
}


// Copy all files at the root level (app)
function copy(){

  return gulp.src([
       './themes/47-things/src/*',
       './themes/47-things/src/**/*',
       '!./themes/47-things/src/styles/**/*',
       '!./themes/47-things/src/scripts/**/*',
       '!./themes/47-things/src/templates',
       '!./themes/47-things/src/templates/**/*',
       '!./themes/47-things/*.html',
     ],{dot: true})
    .pipe(gulp.dest('./themes/47-things/dist/'))
    .pipe($.size({title: 'copy'}));
}

// Compile and automatically prefix stylesheets
function styles(){

    const AUTOPREFIXER_BROWSERS = [
      'ie >= 10',
      'ie_mob >= 10',
      'ff >= 30',
      'chrome >= 34',
      'safari >= 7',
      'opera >= 23',
      'ios >= 7',
      'android >= 4.4',
      'bb >= 10'
    ];

    var plugins = [
        autoprefixer({
          overrideBrowserslist: AUTOPREFIXER_BROWSERS
        }),
        cssnano()
    ];


  // For best performance, don't add Sass partials to `gulp.src`
  return gulp.src([
    './themes/47-things/src/styles/main.scss',
  ])
    .pipe($.newer('.tmp/styles'))
    .pipe($.sourcemaps.init())
    .pipe($.sass({
      precision: 10,
      includePaths: [
        './themes/47-things/src/bower_components/foundation/scss/',
        './vendor/md/uiowa-bar/scss',
        './node_modules/'

      ]
    }).on('error', $.sass.logError))
    .pipe(gulp.dest('.tmp/styles'))
    // Concatenate and minify styles
    .pipe($.if('*.css', $.postcss(plugins)))
    .pipe($.size({title: 'styles'}))
    .pipe($.sourcemaps.write('./'))
    .pipe(gulp.dest('./themes/47-things/dist/styles'));
};

// Concatenate and minify JavaScript. Optionally transpiles ES2015 code to ES5.
// to enable ES2015 support remove the line `"only": "gulpfile.babel.js",` in the
// `.babelrc` file.
function scripts(){
    return gulp.src([
      // Note: Since we are not using useref in the scripts build pipeline,
      //       you need to explicitly list your scripts here in the right order
      //       to be correctly concatenated
      './node_modules/jquery/dist/jquery.js',
      './node_modules/popper.js/dist/umd/popper.min.js',
      './node_modules/tether/dist/js/tether.min.js',
      './node_modules/bootstrap/dist/js/bootstrap.min.js',
      './node_modules/@fortawesome/fontawesome-free/js/regular.js',
      './node_modules/lazysizes/lazysizes.js',
      './node_modules/flickity/dist/flickity.pkgd.js',
      './node_modules/magnific-popup/dist/jquery.magnific-popup.js',
      './themes/47-things/src/scripts/app.js',

    ])
      .pipe($.newer('.tmp/scripts'))
      .pipe($.sourcemaps.init())
      .pipe($.babel())
      .pipe($.sourcemaps.write())
      .pipe(gulp.dest('.tmp/scripts'))
      .pipe($.concat('main.min.js'))
      .pipe($.uglify())
      // Output files
      .pipe($.size({title: 'scripts'}))
      .pipe($.sourcemaps.write('.'))
      .pipe(gulp.dest('./themes/47-things/dist/scripts'));
};

//Scan your HTML for assets & optimize them
function html(){
  return gulp.src('./themes/47-things/src/templates/**/*.ss')
    .pipe($.useref({
      searchPath: '{.tmp,app}',
      noAssets: true
    }))

    // Minify any HTML
    .pipe($.if('*.ss', $.htmlmin({
      removeComments: true,
      collapseWhitespace: true,
      collapseBooleanAttributes: false,
      removeAttributeQuotes: false,
      removeRedundantAttributes: true,
      removeEmptyAttributes: true,
      removeScriptTypeAttributes: true,
      removeStyleLinkTypeAttributes: true,
      removeOptionalTags: false
    })))
    // Output files
    .pipe($.if('*.ss', $.size({title: 'ss', showFiles: true})))
    .pipe(gulp.dest('./themes/47-things/templates/'));
}


// Clean output directory
function clean(){
  return del(['.tmp', './themes/47-things/dist/*', '!dist/.git'], {dot: true})
}

function watch(){
  // gulp.watch(['./themes/47-things/**/*.html'], reload);
  // gulp.watch(['./themes/47-things/src/templates/**/*.ss'], gulp.series(html));
  gulp.watch(['./themes/47-things/src/styles/**/*.{scss,css}'], gulp.series(styles));
  gulp.watch(['./themes/47-things/src/scripts/**/*.js'], gulp.series(lint, scripts));
  gulp.watch(['./themes/47-things/src/images/**/*'], gulp.series(images));
}

// });

// Build production files, the default task
gulp.task('default', gulp.series(clean, copy, gulp.parallel(styles,
    lint, scripts, images,), watch));
