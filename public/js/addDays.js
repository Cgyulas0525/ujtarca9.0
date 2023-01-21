function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    var d = result.getDate();
    var m =  result.getMonth() + 1;
    m = m.toString().length == 1 ? '0'+m.toString() : m.toString();
    var y = result.getFullYear();
    result = (y + "-" + m + "-" + d);
    return result;
}
