module.exports = function () {
    $.gulp.task('watch', function () {
        $.gulp.watch('./assets/stylus/**/*.styl', $.gulp.series('styles:dev'));
        $.gulp.watch('./assets/img/svg/*.svg', $.gulp.series('svg'));
        $.gulp.watch('./assets/js/**/*.js', $.gulp.series('libsJS:dev', 'js:copy'));
        $.gulp.watch(['./assets/img/general/**/*.{png,jpg,gif}',
                     './assets/img/content/**/*.{png,jpg,gif}'], $.gulp.series('img:dev'));
    });
};