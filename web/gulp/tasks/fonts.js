module.exports = function() {
    $.gulp.task('fonts', () => {
        return $.gulp.src('./build/fonts/**/*.*')
            .pipe($.gulp.dest('./web/assets/fonts/'));
    });
};
