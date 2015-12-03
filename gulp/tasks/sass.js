import gulp from 'gulp';
import gulpif from 'gulp-if';
import {sass as config} from '../config';
import browserSync from 'browser-sync';
import sass from 'gulp-sass';
import sourcemaps from 'gulp-sourcemaps';
import handleErrors from '../util/handleErrors';
import autoprefixer from 'gulp-autoprefixer';
import minifyCSS from 'gulp-minify-css';

const env = process.env.NODE_ENV || 'development';

gulp.task('sass', () => {
  return gulp.src([
      config.src + '/site.scss',   // Theme stylesheet
      config.src + '/admin.scss',  // Wordpress Admin stylesheet
      config.src + '/editor.scss', // WYSIWYG Editor stylesheet
    ])

    // Initialize the sourcemaps
    .pipe(sourcemaps.init())
      .on('error', handleErrors)

    // Configure SASS
    .pipe(sass(config.sass))
      .on('error', handleErrors)

    // Autoprefix
    .pipe(autoprefixer(config.autoprefixer))

    // Minify the CSS
    .pipe(minifyCSS())

    // Write the sourcemaps file
    .pipe(gulpif(env === 'development', sourcemaps.write()))

    .pipe(gulp.dest(config.dest))

    .pipe(browserSync.reload({
        stream: true,
      }));
});
