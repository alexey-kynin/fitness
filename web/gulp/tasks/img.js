module.exports = function() {
    $.gulp.task('img:dev', () => {
        return $.gulp.src('./assets/img/**/*.{png,jpg,gif}')
            .pipe($.gulp.dest('./web/build/img/'));
    });

    // $.gulp.task('img:build', () => {
    //     return $.gulp.src('./assets/img/**/*.{png,jpg,gif}')
    //         .pipe($.gp.tinypng(YOUR_API_KEY))
    //         .pipe($.gulp.dest('./web/build/img/'));
    // });


    $.gulp.task('svg:copy', () => {
        return $.gulp.src('./assets/img/general/*.svg')
            .pipe($.gulp.dest('./web/build/img/general/'));
    });
};
