<?php get_header(); ?>
<section class="headings" id="mockup">
	<main>
		<h1 data-aos="slow-title">A build system designed to automate your WordPress development workflow.</h1>
		<div class="codecolorer-container javascript solarized-dark home" data-aos="slow-up">
			<img src="<?php echo get_template_directory_uri(); ?>/img/browser.svg" alt="Browser 🌍" class="mockup">
			<div class="javascript codecolorer">
				<span class="co1">// <em>Step 1</em>: Clone repository from GitHub *</span><br>
				<i>$</i> git clone https<span class="sy0">:</span>//github.com/luangjokaj/wordpressify && cd wordpressify<br>
				<br>
				<span class="co1">// <em>Step 2</em>: Install dependencies *</span><br>
				<i>$</i> npm install<br>
				<br>
				<span class="co1">// <em>Step 3</em>: Install latest WordPress version *</span><br>
				<i>$</i> npm run install<span class="sy0">:</span>wordpress<br>
				<br>
				<span class="co1">// Run development environment</span><br>
				<i>$</i> npm run dev<br>
				<br>
				<span class="co1">// Generate distribution files</span><br>
				<i>$</i> npm run prod<br>
				<br>
				<img draggable="false" class="emoji" alt="🚀" src="https://s.w.org/images/core/emoji/2.3/svg/1f680.svg"><br>
				<br>
				<span class="co1">// * Step 1,2 and 3 are part of the installation process.</span>
			</div>
		</div>
	</main>
</section>
<!-- container -->
<div class="container">
	<!-- site-content -->
	<div class="site-content front-page">
		<section class="tech">
			<ul>
				<li data-aos="flying-icons" data-aos-offset="0">
					<img src="<?php echo get_template_directory_uri(); ?>/img/node.svg" alt="Nodejs ⚙️">
				</li>
				<li data-aos="flying-icons" data-aos-offset="0">
					<img src="<?php echo get_template_directory_uri(); ?>/img/gulp.svg" alt="Gulp 🚀">
				</li>
			</ul>
		</section>
		<h2 class="center fixed" data-aos="fade-up-slow">WordPressify is a modern workflow for your WordPress development, with an integrated web server and auto-reload. Style pre-processors and ES6 ready.</h2>
		<section class="features">
			<ul>
				<li data-aos="slow-list">
					<img src="<?php echo get_template_directory_uri(); ?>/img/features/devserver.svg" alt="Nodejs 💻">
					<h3>Dev Server</h3>
					<p>
						A development server for PHP based in Node. Powered by BrowserSync. 
					</p>
				</li>
				<li data-aos="slow-list">
					<img src="<?php echo get_template_directory_uri(); ?>/img/features/autoreload.svg" alt="Auto Reload 🔄">
					<h3>Auto-Reload</h3>
					<p>
						Watches for all your changes and reloads in real-time.
					</p>
				</li>
				<li data-aos="slow-list">
					<img src="<?php echo get_template_directory_uri(); ?>/img/features/styles.svg" alt="Styles 🎨">
					<h3>Styles</h3>
					<p>
						Styles pre-processors: PostCSS or Scss with sourcemaps.
					</p>
				</li>
				<li data-aos="slow-list">
					<img src="<?php echo get_template_directory_uri(); ?>/img/features/javascript.svg" alt="JavaScript (ES6) 🤓">
					<h3>JavaScript ES6</h3>
					<p>
						Babel compiler for writing next generation JavaScript.
					</p>
				</li>
				<li data-aos="slow-list">
					<img src="<?php echo get_template_directory_uri(); ?>/img/features/libraries.svg" alt="Libraries 📚">
					<h3>External Libraries</h3>
					<p>
						Easy import for external JavaScript libraries and npm scripts.
					</p>
				</li>
				<li data-aos="slow-list">
					<img src="<?php echo get_template_directory_uri(); ?>/img/features/customizable.svg" alt="Customizable ✅">
					<h3>Customizable</h3>
					<p>
						Flexible build customization, managed by Gulp tasks.
					</p>
				</li>
			</ul>
		</section>
		<section class="github" data-aos="slow-button" data-aos-offset="100">
			<a href="https://github.com/luangjokaj/wordpressify" target="_blank" class="button icon github">GitHub</a>
		</section>
	</div>
	<!-- /site-content -->
</div>
<!-- /container -->
<?php get_footer(); ?>