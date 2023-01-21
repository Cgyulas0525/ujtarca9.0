function chartDataUpload(data, fields, names){
    chartdata = [];
    for (i = 0; i < fields.length; i++) {
        array = [];
        for (j = 0; j < data.length; j++) {
            array.push(parseInt(data[j][fields[i]]));
        }
        chartdata.push({name: names[i], data: array});
    }
    return chartdata;
}
