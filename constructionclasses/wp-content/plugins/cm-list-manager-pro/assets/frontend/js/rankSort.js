//set up funtion
// this converts time from 3p format

function sortRankAsc(){


//First we need to select otter most column for each column and put them in their own array.
var getColumns = document.querySelectorAll('.categorySort');

//second we need to search each column for the date element time to make the loop to select each column
//getColumns.forEach(column => console.log(column)); this gets all the columns on their own

//this needs to go into a funtion to restart itself
var categoryClassLists = [];

getColumns.forEach(function(column){
     categoryClassLists.push(column.children[1]);
    });

categoryClassLists.forEach(function(list){
    //console.log(list.children[0].children[2].children[0].textContent);
    
    
    [...list.children].sort(function(a,b){
        console.log(a.children[2].textContent);

        if(a.children[2].children[0].textContent < b.children[2].children[0].textContent){
            return -1;
        }
        if(a.children[2].children[0].textContent > b.children[2].children[0].textContent){
            return 1;
        }

        return 0;

    }).forEach(node=>list.appendChild(node));

    });

}


//set up funtion
// this converts time from 3p format

function sortRankDesc(){
    
    

//First we need to select otter most column for each column and put them in their own array.
var getColumns = document.querySelectorAll('.categorySort');

//second we need to search each column for the date element time to make the loop to select each column
//getColumns.forEach(column => console.log(column)); this gets all the columns on their own

//this needs to go into a funtion to restart itself
var categoryClassLists = [];

getColumns.forEach(function(column){
     categoryClassLists.push(column.children[1]);
    });

categoryClassLists.forEach(function(list){
    //console.log(list.children[0].children[2].children[0].textContent);
    
    
    [...list.children].sort(function(a,b){
        console.log(a.children[2].children[0].textContent);

        if(a.children[2].children[0].textContent < b.children[2].children[0].textContent){
            return 1;
        }
        if(a.children[2].children[0].textContent > b.children[2].children[0].textContent){
            return -1;
        }

        return 0;

    }).forEach(node=>list.appendChild(node));

    });
    
}






