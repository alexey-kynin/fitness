module.exports = function() {
    $.gulp.task('fonts', () => {
        return $.gulp.src('./assets/fonts/**/*.*')
            .pipe($.gulp.dest('./web/build/fonts/'));
    });
};
