module.exports = function() {
    $.gulp.task('libsJS:dev', () => {
        return $.gulp.src(['node_modules/svg4everybody/dist/svg4everybody.min.js'])
            .pipe($.gp.concat('libs.min.js'))
            .pipe($.gulp.dest('./web/assets/js/'))
            .pipe($.browserSync.reload({
                stream: true
            }));
    });

    $.gulp.task('libsJS:build', () => {
        return $.gulp.src(['node_modules/svg4everybody/dist/svg4everybody.min.js'])
            .pipe($.gp.concat('libs.min.js'))
            .pipe($.gp.uglifyjs())
            .pipe($.gulp.dest('./web/assets/js/'));
    });

    $.gulp.task('js:copy', () => {
        return $.gulp.src(['./build/js/*.js',
                           '!./build/js/libs.min.js'])
            .pipe($.gulp.dest('./web/assets/js/'))
            .pipe($.browserSync.reload({
                stream: true
            }));
    });
};
