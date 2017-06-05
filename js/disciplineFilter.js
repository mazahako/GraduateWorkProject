function disciplineFilter() {
    return function (items, params) {
        var result = [];
        if(items === undefined) return [];
        for (var i = 0; i < items.length; i++) {
            for(var c = 0; c < params.course.length; c++){
                if((params.course[c].state == true)&&(items[i].course.indexOf(params.course[c].num) >= 0)){
                    for(var t = 0; t < params.type.length; t++){
                        if((params.type[t].state == true)&&(items[i].type.indexOf(params.type[t].id) >= 0)){
                            result[result.length] = items[i];
                            break;
                        }
                    }
                    break;
                }
            }
        }
        return result;
    }
}
