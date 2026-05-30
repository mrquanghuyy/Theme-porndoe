<?php
get_header();
?>
<div class="bg-neutral-950 text-neutral-200 font-sans antialiased h-screen w-full flex flex-col items-center justify-center relative overflow-hidden selection:bg-red-500 selection:text-white">
	<div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[40rem] h-[40rem] bg-red-700 rounded-full blur-[128px] opacity-20 pointer-events-none animate-glow">
	</div>
	<main class="container mx-auto px-4 text-center relative z-10">
			<h1 class="text-9xl font-extrabold mb-2 text-transparent bg-clip-text bg-gradient-to-b from-red-500 to-red-900 drop-shadow-lg">
					404
			</h1>

			<h2 class="text-3xl font-light text-white tracking-widest uppercase mb-6 border-b border-red-900/50 inline-block pb-2">
					Page Not Found
			</h2>

			<p class="text-neutral-400 text-lg max-w-md mx-auto mb-10 leading-relaxed">
					The page you are looking for has been moved, removed, or is strictly off-limits.
			</p>

			<a href="/" class="group relative inline-flex items-center gap-2 px-8 py-4 bg-red-700 text-white rounded-full font-semibold tracking-wide transition-all duration-300 hover:bg-red-600 hover:shadow-[0_0_20px_rgba(220,38,38,0.6)] hover:-translate-y-1">
					<span>Return Home</span>
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1">
							<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"></path>
					</svg>
			</a>
	</main>
</div>

<?php
get_footer();
?>
