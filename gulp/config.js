export const dest = './assets/dist';
export const src = './assets';
const app = './app';
const host = 'dpatents.dev';

export const browserSync = {
  proxy: host,
  ghostMode: {
    clicks: false,
    location: false,
    forms: false,
    scroll: false,
  },
};

export const javascript = {
  src: src + '/js',
  dest: dest,
};

export const sass = {
  src: src + '/sass/**',
  dest: dest,
  sass: {
    sourceComments: 'map',
    imagePath: '/img',
    errLogToConsole: true,
    includePaths: ['sass'],
  },
  autoprefixer: {
    browsers: ['last 2 version'],
  },
};

export const markup = {
  src: [
    './**/*.php',
    app + '/**/*.twig',
  ],
};

export const images = {
  src: src + '/img/**/*',
  dest: dest + '/img',
  svgo: {
    removeViewBox: false,
    cleanupIDs: false,
    removeUnknownsAndDefaults: false,
  },
};

export const fonts = {
  src: src  + '/fonts/**/*',
  dest: dest  + '/fonts',
};

