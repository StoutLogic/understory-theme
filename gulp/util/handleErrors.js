import notify from 'gulp-notify';

module.exports = function handleErrors() {
  const args = Array.prototype.slice.call(arguments);

  notify
    .onError({
      title: 'Compile Error',
      message: '<%= error.message %>',
    })
    .apply(this, args);

  this.emit('end');
};
