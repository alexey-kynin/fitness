module.exports = function() {
    $.gulp.task('clean', function() {
        return $.del([
            './web/build'
        ]);
    });
};