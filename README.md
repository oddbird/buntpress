## Getting Started

### Prerequisites

This theme uses:
[Node](http://nodejs.org/)
[Gulp CLI](https://github.com/gulpjs/gulp-cli) (`npm install -g gulp-cli`).


## Development

After you've installed and activated me. It's time to setup Gulp.

1) From the command line, change directories to your new theme directory

```bash
cd /your-project/wp-content/themes/buntpress
```

2) Install Node dependencies

```bash
npm install
```

### Gulp Tasks

From the command line, type any of the following to perform an action:

`gulp watch` - Automatically handle changes to CSS, JS, SVGs, and image sprites. Also kicks off BrowserSync.

`gulp icons` - Minify, concatenate, and clean SVG icons.

`gulp i18n` - Scan the theme and create a POT file

`gulp sass:lint` - Run Sass against WordPress code standards

`gulp scripts` - Concatenate and minify javascript files

`gulp sprites` - Generate an image sprite and the associated Sass (sprite.png)

`gulp styles` - Compile, prefix, combine media queries, and minify CSS files

`gulp` - Runs the following tasks at the same time: i18n, icons, scripts, styles, sprites
