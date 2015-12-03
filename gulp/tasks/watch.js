import gulp from 'gulp';
import watch from 'gulp-watch';
import * as config from './../config';

gulp.task('watch', ['browserSync'], () => {
  watch([config.sass.src, config.src + '/components/**/*.scss'], () => { gulp.start('sass'); });
  watch(config.fonts.src, () => { gulp.start('fonts'); });
  watch([config.javascript.src + '/**/*.js', config.src + '/components/**/*.js'], () => { gulp.start('javascript'); });
  watch(config.images.src, () => { gulp.start('images'); });
  watch(config.markup.src, () => { gulp.start('markup'); });
});
