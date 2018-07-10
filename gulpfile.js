var gulp = require('gulp');
var sass = require('gulp-sass');




gulp.task('scss', function() {
    console.log('编译scss');
    return gulp.src('./scss/**/*.scss')
            .pipe(sass())
            .pipe(gulp.dest('./css'))
});

gulp.task('default', function() {
    console.log('gulp task 启动成功')
});