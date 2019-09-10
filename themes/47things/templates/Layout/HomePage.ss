
<div class="hero">
    <div class="container" style="position: relative; z-index: 1;">
        <div class="row">
            <div class="col-sm-12 ">
                <h1 class="text-center display-4 mb-3">
                    <img src="$ThemeDir/dist/images/47things.jpg" alt="47 Things You Should Do At IOWA">
                </h1>
                <% if $Youtube %>
                    <div class='embed-container'>
                        <iframe src="$Youtube" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen title="University of Iowa Bucket List"></iframe>
                    </div>
                <% end_if %>
            </div>
        </div>
    </div>
</div>


<main role="main">

<% if $Things %>
    <section class="container">
        <div class="card-deck">
             <% loop $Things %>
                <% if $MultipleOf(7) %><!-- use image overlay every 7 cards -->
                    <div class="card mb-4 bg-dark text-white">
                        <img data-src="$MainImage.Fill(300,450).URL" class="card-img-top lazyload" alt="$Title">
                        <div class="card-img-overlay d-flex align-items-center">
                            <div class="card-body">
                                <div class="card-text">$Content</div>
                            </div>
                        </div>
                    </div>
                <% else %>
                    <div class="card mb-4">
                        <% if $MainImage %>
                            <div class="diagonal">
                                <img data-src="$MainImage.Fill(500,400).URL" class="card-img-top lazyload" alt="$Title">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" class="diagonal-svg">
                                    <polygon fill="white" points="0,100 100,0 100,100"/>
                                </svg>
                            </div>
                        <% end_if %>
                        <div class="card-body">
                            <div class="card-text">$Content</div>
                        </div>
                    </div>
                <% end_if %>

                <% if $MultipleOf(2) %>
                    <div class="w-100 d-none d-sm-block d-md-none"><!-- break every 2 on sm--></div>
                <% end_if %>
                <% if $MultipleOf(3) %>
                    <div class="w-100 d-none d-md-block d-lg-none"><!-- break every 3 on md--></div>
                <% end_if %>
                <% if $MultipleOf(4) %>
                    <div class="w-100 d-none d-lg-block"></div><!-- break every 4 on lg-->
                <% end_if %>


            <% end_loop %>
        </div>
    </section>
<% end_if %>



</main>


