import cache from 'gulp-cached';
import gulp from 'gulp';
import imagemin from 'gulp-imagemin';
import pngquant from 'imagemin-pngquant';
import {images as config} from '../config';
import browserSync from 'browser-sync';

gulp.task('images', () => {
  return gulp.src(config.src)

    // Operate only on images that have cached
    .pipe(cache('images'))

    // Compress the images
    .pipe(imagemin({
        progressive: true,
        use: [pngquant()],
        svgoPlugins: [config.svgo],
      }))

    .pipe(gulp.dest(config.dest))
    .pipe(browserSync.reload({
        stream: true,
      }));
});
