'use strict';

var gulp = require( 'gulp' );
var sass = require('gulp-sass')(require('sass'));
var cleanCSS = require( 'gulp-clean-css' );
var rename = require( 'gulp-rename' );
var minify = require( 'gulp-minify' );
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var browserSync = require('browser-sync').create();

var paths = {
  styles: {
    src: 'frontend/resources/sass/**/*.scss',
    dest: 'frontend/static/css/',
  },
  scripts: {
    src: ['frontend/resources/js/**/*.js', '!frontend/resources/js/**/*.min.js'],
    dest: 'frontend/static/js/',
  },
};

var componentPaths = {
  styles: {
    src: 'frontend/components/**/*.scss',
    dest: 'frontend/static/css/',
  },
  scripts: {
    src: ['frontend/components/**/*.js', '!frontend/components/**/*.min.js'],
    dest: 'frontend/static/js/',
  },
};

var blocks = {
  styles: {
    src: 'acf/blocks/*/css/*.scss',
  },
  scripts: {
    src: ['acf/blocks/**/js/*.js', '!acf/blocks/**/js/*.min.js'],
  },
};

var dashboard = {
  styles: {
    src: 'dashboard/*.scss',
  },
};

var sassOptions = {
	errLogToConsole: true,
	outputStyle: 'expanded',
};

// BrowserSync configuration
var browserSyncOptions = {
	// For Local by Flywheel WordPress development
	proxy: "apex-digital-academy.local", // Change this to your Local site URL
	
	files: [
		'frontend/static/css/*.css',
		'frontend/static/js/*.js',
		'./**/*.php',
		'./**/*.html',
		'./**/*.twig',
	],
	port: 3000,
	open: true,
	notify: false,
	reloadOnRestart: true,
	injectChanges: true,
};

/*
 * Define our tasks using plain functions
 */
function styles() {
	return gulp.src( paths.styles.src )
		.pipe( sass( sassOptions ).on( 'error', sass.logError ) )
		.pipe( cleanCSS( { compatibility: 'ie8' } ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( gulp.dest( paths.styles.dest ) )
		.pipe( browserSync.stream() ); // Inject CSS changes
}

function scripts() {
  return gulp.src(paths.scripts.src, { sourcemaps: true })
    .pipe(uglify())
    .pipe(rename({ suffix: ".min" }))
    .pipe(gulp.dest(paths.scripts.dest))
    .pipe(browserSync.stream());
}

function componentStyles() {
	return gulp.src( componentPaths.styles.src )
		.pipe( sass( sassOptions ).on( 'error', sass.logError ) )
    .pipe( concat( 'components.css' ) )
		.pipe( cleanCSS( { compatibility: 'ie8' } ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( gulp.dest( componentPaths.styles.dest ) )
		.pipe( browserSync.stream() ); // Inject CSS changes
}

function componentScripts() {
	return gulp.src( componentPaths.scripts.src, { sourcemaps: true } )
    .pipe( concat( 'components.js' ) )
    .pipe( uglify() )
		.pipe( minify( {
			ext: {
				min: '.min.js',
			},
		} ) )
		.pipe( gulp.dest( componentPaths.scripts.dest ) )
		.pipe( browserSync.stream() ); // Reload browser for JS changes
}

function blockStyles() {
	return gulp.src( blocks.styles.src )
		.pipe( sass( sassOptions ).on( 'error', sass.logError ) )
		.pipe( cleanCSS( { compatibility: 'ie8' } ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe(gulp.dest(function (file) {
			return file.base;
		}))
		.pipe( browserSync.stream() ); // Inject CSS changes
}

function blockScripts() {
  return gulp.src(blocks.scripts.src, { sourcemaps: true })
    .pipe(uglify())
    .pipe(rename({ suffix: ".min" }))
    .pipe(gulp.dest(function (file) {
      return file.base;
    }))
    .pipe(browserSync.stream());
}
function dashboardStyles() {
	return gulp.src( dashboard.styles.src )
		.pipe( sass( sassOptions ).on( 'error', sass.logError ) )
		.pipe( cleanCSS( { compatibility: 'ie8' } ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe(gulp.dest(function (file) {
			return file.base;
		}))
		.pipe( browserSync.stream() ); // Inject CSS changes
}

// BrowserSync task
function serve(done) {
	browserSync.init(browserSyncOptions);
	done();
}

// Watch task with BrowserSync
function watch(done) {
	gulp.watch( paths.scripts.src, scripts );
	gulp.watch( paths.styles.src, styles );
  	gulp.watch( componentPaths.scripts.src, componentScripts );
	gulp.watch( componentPaths.styles.src, componentStyles );
	gulp.watch( blocks.scripts.src, blockScripts );
	gulp.watch( blocks.styles.src, blockStyles );
	gulp.watch( dashboard.styles.src, dashboardStyles );
	gulp.watch('*.php').on('change', browserSync.reload);
	gulp.watch('*.html').on('change', browserSync.reload);
	done();
}

/*
 * Specify if tasks run in series or parallel using `gulp.series` and `gulp.parallel`
 */
var build = gulp.series( gulp.parallel( styles, scripts, componentStyles, componentScripts ) );

// Development task that runs build, starts BrowserSync, and watches for changes
var dev = gulp.series( build, gulp.parallel( serve, watch ) );

/*
 * CommonJS `exports` module notation to declare tasks
 */
exports.styles = styles;
exports.scripts = scripts;
exports.watch = watch;
exports.build = build;
exports.serve = serve;
exports.dev = dev;

/*
 * Define default task that can be called by just running `gulp` from cli
 */
exports.default = dev;