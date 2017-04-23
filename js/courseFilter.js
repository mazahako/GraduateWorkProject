function courseFilter() {
    return function (items, course) {
        var result = [];
        for (var i = 0; i < items.length; i++) {
            for (var j = 0; j < course.length; j++) {
                if (items[i].course.indexOf(course[j].toString()) >= 0) {
                    result[result.length] = items[i];
                    break;
                }
            }
        }
        return result;
    }
}