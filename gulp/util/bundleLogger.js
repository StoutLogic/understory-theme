import gutil from 'gulp-util';
import prettyHrtime from 'pretty-hrtime';

let startTime = null;

export function start(filepath) {
  startTime = process.hrtime();
  gutil.log('Bundling', gutil.colors.green(filepath) + '...');
}

export function watch(bundleName) {
  gutil.log('Watching files required by', gutil.colors.yellow(bundleName));
}

export function end(filepath) {
  taskTime = process.hrtime(startTime);
  prettyTime = prettyHrtime(taskTime);
  gutil.log('Bundled', gutil.colors.green(filepath), 'in', gutil.colors.magenta(prettyTime));
}
