'use strict';

let gulp         = require('gulp'),
	rename       = require("gulp-rename"),
	notify       = require('gulp-notify'),
	autoprefixer = require('gulp-autoprefixer'),
	sass         = require('gulp-sass');

//css
gulp.task('css', () => {
	return gulp.src('./assets/scss/jet-elements.scss')
		.pipe(sass( { outputStyle: 'compressed' } ))
		.pipe(autoprefixer({
				browsers: ['last 10 versions'],
				cascade: false
		}))

		.pipe(rename('jet-elements.css'))
		.pipe(gulp.dest('./assets/css/'))
		.pipe(notify('Compile Sass Done!'));
});

gulp.task('css-skin', () => {
	return gulp.src('./assets/scss/jet-elements-skin.scss')
		.pipe(sass( { outputStyle: 'compressed' } ))
		.pipe(autoprefixer({
				browsers: ['last 10 versions'],
				cascade: false
		}))

		.pipe(rename('jet-elements-skin.css'))
		.pipe(gulp.dest('./assets/css/'))
		.pipe(notify('Compile Sass Done!'));
});

//watch
gulp.task('watch', () => {
	gulp.watch('./assets/scss/**', ['css']);
	gulp.watch('./assets/scss/**', ['css-skin']);
});
