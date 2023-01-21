function categoryUpload(data, field){
    category = [];
    for (i = 0; i < data.length; i++){
        category.push(data[i][field]);
    }
    return category;
}
