module.exports = function () {
    $.gulp.task('watch', function () {
        $.gulp.watch('./build/stylus/**/*.styl', $.gulp.series('styles:dev'));
        $.gulp.watch('./build/img/svg/*.svg', $.gulp.series('svg'));
        $.gulp.watch('./build/js/**/*.js', $.gulp.series('libsJS:dev', 'js:copy'));
        $.gulp.watch(['./build/img/general/**/*.{png,jpg,gif}',
                     './build/img/content/**/*.{png,jpg,gif}'], $.gulp.series('img:dev'));
    });
};