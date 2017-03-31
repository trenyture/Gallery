var gulp = require('gulp'),
    watch = require('gulp-watch'),
	/*CSS*/
	compass = require('gulp-compass'),
	minifyCSS = require('gulp-minify-css'),
	path = require('path'),
	/*IMAGES*/
	imagemin = require('gulp-imagemin'),
	clean = require('gulp-dest-clean'),
	/*JS*/
	jshint = require('gulp-jshint'),
	uglify = require('gulp-uglify'),
	concat = require('gulp-concat'),
	/*Notifications*/
	notify = require('gulp-notify');


/*IF ONLY GULP*/
gulp.task('default', function(){
	gulp.run('watch');
});

gulp.task('build', function(){
    gulp.run('styles');
    gulp.run('scripts');
    gulp.run('images');
});


/*WE BUILD THE APP*/
gulp.task('watch', ['styles','scripts','images'], function(){
    gulp.watch(['dev/sass/*/*.scss', 'dev/sass/*.scss'], ['styles']);
    gulp.watch(['dev/js/vendor/*.js', 'dev/js/*.js'], ['scripts']);
    gulp.watch(['dev/img/*/*', 'dev/img/*'], ['images']);
});

/*MINIFY CSS and TRANSFROM SCSS in CSS*/
gulp.task('styles', function(){
	/*CLEAN FOLDER*/
	gulp.src('dev/sass')
		.pipe(clean('assets/css'));
	gulp.src('dev/sass/*.scss')
	    .pipe(compass({
	      css: 'assets/css',
	      sass: 'dev/sass',
	      images: 'dev/img',
	    }))
	    .pipe(gulp.dest('assets/css'))
		.pipe(minifyCSS())
		.pipe(gulp.dest('assets/css'))
		.pipe(notify({ message: 'Styles task complete' }));
});

/*JOIN ALL SCRIPTS AND MINIFY*/
gulp.task('scripts', function(){
	/*CLEAN FOLDER*/
	gulp.src('dev/js')
		.pipe(clean('assets/js'));
	gulp.src(['dev/js/vendor/*.js', 'dev/js/*.js'])
	    .pipe(jshint())
	    .pipe(jshint.reporter('default'))
	    .pipe(concat('main.js'))
	    .pipe(gulp.dest('assets/js'))
	    .pipe(uglify())
	    .pipe(gulp.dest('assets/js'))
	    .pipe(notify({ message: 'Scripts task complete' }));
});

/*OPTIMIZE IMAGES*/
gulp.task('images', function(){
	/*CLEAN FOLDER*/
	gulp.src('dev/img')
		.pipe(clean('assets/img'));
	gulp.src(['dev/img/*/*', 'dev/img/*'])
        .pipe(imagemin([imagemin.gifsicle(), imagemin.jpegtran(), imagemin.optipng(), imagemin.svgo()]))
        .pipe(gulp.dest('assets/img'))
        .pipe(notify({ message: 'Images task complete' }));
});
