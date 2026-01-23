<div class="container-fluid portfolio">
        <div class="container">
            <!-- Section Header -->
            <div class="section-title text-center" data-aos="fade-up">
                <h2>Portfolio</h2>
                <p>A selection of projects developed using various technologies across different industries.</p>
            </div>

            <!-- Portfolio Grid -->
            <div class="row g-4">
                <!-- Card 1 -->
                  <div class="col-12 col-md-6 col-lg-3" data-aos="zoom-in">
                    <a href="{{ route('design') }}" class="portfolio-card">
                        <div class="card-thumbnail">
                            <img src="{{ asset('image/design-portfolio.jpg') }}">
                            <span class="card-category">Design</span>
                        </div>
                        <div class="card-content">
                            <h3>Design</h3>
                            <p>Creative visual designs that communicate ideas clearly and leave a strong, memorable impression across digital platforms.</p>
                        </div>
                    </a>
                </div>

                <!-- Card 2 -->
                <div class="col-12 col-md-6 col-lg-3"  data-aos="zoom-in">
                    <a href="{{ route('video') }}" class="portfolio-card">
                        <div class="card-thumbnail">
                            <img src="{{ asset('image/video-portfolio.jpg') }}">
                            <span class="card-category">Video Editing</span>
                        </div>
                        <div class="card-content">
                            <h3>Video Editing</h3>
                            <p>Engaging video edits crafted to tell compelling stories, enhance visuals, and keep audiences fully immersed.</p>
                        </div>
                    </a>
                </div>

                <!-- Card 3 -->
                <div class="col-12 col-md-6 col-lg-3"  data-aos="zoom-in">
                    <a href="{{ route('ui') }}" class="portfolio-card">
                        <div class="card-thumbnail">
                            <img src="{{ asset('image/ui.jpg') }}">
                            <span class="card-category">UI/UX</span>
                        </div>
                        <div class="card-content">
                            <h3>UI/UX</h3>
                            <p>User-centered interface and experience designs focused on usability, clarity, and seamless digital interaction.</p>
                        </div>
                    </a>
                </div>

                <!-- Card 4 -->
                <div class="col-12 col-md-6 col-lg-3"  data-aos="zoom-in">
                    <a href="{{ route('game') }}" class="portfolio-card">
                        <div class="card-thumbnail">
                            <img src="{{ asset('image/game.jpg') }}">
                            <span class="card-category">Game</span>
                        </div>
                        <div class="card-content">
                            <h3>Game</h3>
                            <p>Interactive game visuals and environments designed to deliver immersive gameplay and engaging player experiences.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>