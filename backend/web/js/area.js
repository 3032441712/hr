function init_area(province, city, district)
{
    var provinceObj = $('#'+province);
    var cityObj = $('#'+city);
    var districtObj = $('#'+district);

    init_data(provinceObj, cityObj, districtObj);
}

function init_data(provinceObj, cityObj, districtObj)
{
    $.get('area/area.json', {}, function(data) {
        provincezValue = provinceObj.attr('data');
        cityValue = cityObj.attr('data');;
        districtValue = districtObj.attr('data');;
        
        provinceObj.empty();
        for (k in data) {
            selected = (k == provincezValue ? 'selected="selected"' : '');
            provinceObj.append('<option ' + selected + ' value="'+k+'">'+data[k].title+'</option>');
        }
        
        cityObj.empty();
        for (k in data[provincezValue]) {
            if (k == 'title' || k == 'parent_id') {
                continue;
            }
            selected = (k == cityValue ? 'selected="selected"' : '');
            cityObj.append('<option '+selected+' value="'+k+'">'+data[provincezValue][k].title+'</option>');
        }
        
        districtObj.empty();
        for (k in data[provincezValue][cityValue]) {
            if (k == 'title' || k == 'parent_id') {
                continue;
            }
            selected = (k == districtValue ? 'selected="selected"' : '');
            districtObj.append('<option '+selected+' value="'+k+'">'+data[provincezValue][cityValue][k].title+'</option>');
        }
    }, 'json');
}

function area_change(v, o)
{
    $.get('area/area.json', {}, function(data) {
        i = 1;
        o.empty();
        for (k in data[v]) {
            if (k == 'title' || k == 'parent_id') {
                continue;
            }
            if (i == 1) {
                o.attr('data', k);
            }
            o.append('<option value="'+k+'">'+data[v][k].title+'</option>');
            i++;
        }
    }, 'json');
}