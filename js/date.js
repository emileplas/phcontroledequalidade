function getYear(){
    var year = new Date().getFullYear();
    document.getElementById('year').innerHTML = new Date().getFullYear();
    console.log(year)
}

getYear()