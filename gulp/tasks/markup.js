import gulp from 'gulp';
import {markup as config} from '../config';
import cache from 'gulp-cached';
import browserSync from 'browser-sync';

gulp.task('markup', () => {
  return gulp.src(config.src)
    .pipe(cache('markup'))
    .pipe(browserSync.reload({
        stream: true,
      }));
});
