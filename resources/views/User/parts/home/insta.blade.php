<style>
    .insta-img {
        width: 314px !important;
        height: 314px !important;
    }
</style>
<section id="instafeed-section" class="pt-15 pt-lg-16">
    <div class="container container-xxl">
        <div class="row align-items-center">
            <div class="col-md-6 mb-md-9" data-animate="fadeInUp">
                <h2 class="fs-3 mb-0">On the Gram</h2>
            </div>
            <div class="col-md-6 mb-10 mb-md-9" data-animate="fadeInUp">
                <p class="fs-18px fw-semibold text-primary text-md-end mb-0">@abhinesh</p>
            </div>
        </div>
        <div id="instafeed-container" class="mx-n6 slick-slider" data-slick-options='{"slidesToShow": 5,"infinite":false,"autoplay":false,"dots":false,"arrows":false,"responsive":[{"breakpoint": 1366,"settings": {"slidesToShow":5 }},{"breakpoint": 992,"settings": {"slidesToShow":2}},{"breakpoint": 768,"settings": {"slidesToShow": 3}},{"breakpoint": 576,"settings": {"slidesToShow": 2}}]}'>
            
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/gh/stevenschobert/instafeed.js@2.0.0rc1/src/instafeed.min.js"></script>
<script type="text/javascript">
    var userFeed = new Instafeed({
        get: 'user',
        target: "instafeed-container",
        resolution: 'low_resolution',
        limit: 5,
        template: '<div class="px-6" data-animate="fadeInUp"><a href="@{{link}}" title="@{{caption}}" target="_blank" class=" hover-zoom-in hover-shine  card-img-overlay-hover hover-zoom-in hover-shine d-block"><img class="lazy-image insta-img img-fluid w-100" width="314" height="314" data-src="@{{image}}" alt="instagram-01" src="@{{image}}"><span class="card-img-overlay bg-dark bg-opacity-30"></span></a></div>',
        accessToken: 'IGQWRQUllDMXNaMTVFMW9hV3B1V1Bvelhrbzh4NURfMnEwUEdwVFkwdjU3X1c4dDYxSmtHVWlsOGVDVXRsdEFmbS1vbXlXeXlLLVdFbnVTdDBkVWJqaXRYSDFVVWltZAVJhM3R3dXJ4cmdITy1VQThyOUh2aWZAjdzAZD',
        success: function(response) {
            if (response.data.length > 0) {
                document.getElementById('instafeed-section').style.display = 'block';
            } else {
                document.getElementById('instafeed-section').style.display = 'none';
            }
        }
    });
    userFeed.run();
</script>