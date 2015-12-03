import gulp from 'gulp';
import cache from 'gulp-cached';
import {fonts as config} from '../config';
import browserSync from 'browser-sync';

gulp.task('fonts', () => {
  return gulp.src(config.src)

    // Operate only on images that have cached
    .pipe(cache('fonts'))

    .pipe(gulp.dest(config.dest))
    .pipe(browserSync.reload({
        stream: true,
      }));
});
