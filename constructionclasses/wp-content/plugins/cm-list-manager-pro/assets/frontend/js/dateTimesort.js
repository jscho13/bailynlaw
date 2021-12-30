//set up funtion
// this converts time from 3p format

function sortAsc(){

    console.log(`Pressed`);

var convertTime12to24 = (time12h) => {
    //console.log(time12h);
    //console.log(time12h.split(' '));
    const [emptytOne, emptyTwo, time, modifier] = time12h.split(' ');
    //console.log(time);
    
    let [hours, minutes] = time.split(':');
    
    if(minutes === undefined){
        minutes = '00';
    }

    if (hours === '12') {
      hours = '00';
    }
  
    if (modifier === 'PM') {
      hours = parseInt(hours, 10) + 12;
    }
  
    return `${hours}:${minutes}`;
  }
  
  //console.log(convertTime12to24('01:02 PM'));
  //console.log(convertTime12to24('05:06 PM'));
  //console.log(convertTime12to24('12:00 PM'));
  //console.log(convertTime12to24('12:00 AM'));


//First we need to select otter most column for each column and put them in their own array.
var getColumns = document.querySelectorAll('.categorySort');

//second we need to search each column for the date element time to make the loop to select each column
//getColumns.forEach(column => console.log(column)); this gets all the columns on their own

//this needs to go into a funtion to restart itself
var categoryClassLists = [];

getColumns.forEach(function(column){
     categoryClassLists.push(column.children[1]);
    });

//console.log(categoryClassLists);
//this gets the second element in the cmlm category group
//getColumns[0].children[1];
//this lets us step into the list of classes so we can start the sort
//getColumns[0].children[1].children;
// time to loop through each class list isself

//var classes = [];
//var classTimes = [];
//need to put this in a key value pair to change the order of the list
categoryClassLists.forEach(function(list){
    //console log each list
    //console.log(list);
    //[...list.children].sort( (a,b)=>a.innerText>b.innerText?1:-1).forEach(node=>list.appendChild(node));
    [...list.children].sort(function(a,b){
        //console.log(a.children[1].textContent);
        if(a.children[1].textContent.includes('at') && b.children[1].textContent.includes('at')){

            var aDate = a.children[1].textContent.split('at')[0];
            var bDate = b.children[1].textContent.split('at')[0];
            var aTime = convertTime12to24(a.children[1].textContent.split('at')[1]);
            var bTime = convertTime12to24(b.children[1].textContent.split('at')[1]);
            var aDateTime = Date.parse(`${aDate} ${aTime}`);
            var bDateTime = Date.parse(`${bDate} ${bTime}`);
        }else{
            var aDate = a.children[1].textContent;
            var bDate = b.children[1].textContent;
            var aDateTime = Date.parse(`${aDate}`);
            var bDateTime = Date.parse(`${bDate}`);
        }


        //console.log(aDateTime);
        //console.log(bDateTime);
        if(aDateTime < bDateTime){
            return -1;
        }
        if(aDateTime > bDateTime){
            return 1;
        }

        return 0;

    }).forEach(node=>list.appendChild(node));




    //console.log(list);


/*------ Nothing but test code and notes below

    //var classes = list.children;
    //console.log(classes);
    //sort each list and its elements inside of it
    //console.log(list);
    
    /*
    classes.forEach(function(clas){
        // this is the time
        //console.log(clas.children[1].textContent.split('@'));
        //console.log(clas.children[1].textContent.split('@')[1]);

        //gets the date and time to numbers to sort
        var dayOfClass;
        var timeOfClass;
        timeOfClass = convertTime12to24(clas.children[1].textContent.split('@')[1]);
        dayOfClass = clas.children[1].textContent.split('@')[0];
        console.log(Date.parse(`${dayOfClass} ${timeOfClass}`));


    });
    */

    });

}


//set up funtion
// this converts time from 3p format

function sortDesc(){
    console.log(`Pressed`);

    var convertTime12to24 = (time12h) => {
        //console.log(time12h);
        //console.log(time12h.split(' '));
        const [emptytOne, emptyTwo, time, modifier] = time12h.split(' ');
        //console.log(time);
        
        let [hours, minutes] = time.split(':');
        
        if(minutes === undefined){
            minutes = '00';
        }
    
        if (hours === '12') {
          hours = '00';
        }
      
        if (modifier === 'PM') {
          hours = parseInt(hours, 10) + 12;
        }
      
        return `${hours}:${minutes}`;
      }
      
      //console.log(convertTime12to24('01:02 PM'));
      //console.log(convertTime12to24('05:06 PM'));
      //console.log(convertTime12to24('12:00 PM'));
      //console.log(convertTime12to24('12:00 AM'));
    
    
    //First we need to select otter most column for each column and put them in their own array.
    var getColumns = document.querySelectorAll('.categorySort');
    
    //second we need to search each column for the date element time to make the loop to select each column
    //getColumns.forEach(column => console.log(column)); this gets all the columns on their own
    
    //this needs to go into a funtion to restart itself
    var categoryClassLists = [];
    
    getColumns.forEach(function(column){
         categoryClassLists.push(column.children[1]);
        });
    
    //console.log(categoryClassLists);
    //this gets the second element in the cmlm category group
    //getColumns[0].children[1];
    //this lets us step into the list of classes so we can start the sort
    //getColumns[0].children[1].children;
    // time to loop through each class list isself
    
    //var classes = [];
    var classTimes = [];
    //need to put this in a key value pair to change the order of the list
    categoryClassLists.forEach(function(list){
        //console log each list
        //console.log(list);
        //[...list.children].sort( (a,b)=>a.innerText>b.innerText?1:-1).forEach(node=>list.appendChild(node));
        [...list.children].sort(function(a,b){
            //console.log(a.children[1].textContent);
            if(a.children[1].textContent.includes('at') && b.children[1].textContent.includes('at')){
    
                var aDate = a.children[1].textContent.split('at')[0];
                var bDate = b.children[1].textContent.split('at')[0];
                var aTime = convertTime12to24(a.children[1].textContent.split('at')[1]);
                var bTime = convertTime12to24(b.children[1].textContent.split('at')[1]);
                var aDateTime = Date.parse(`${aDate} ${aTime}`);
                var bDateTime = Date.parse(`${bDate} ${bTime}`);
            }else{
                var aDate = a.children[1].textContent;
                var bDate = b.children[1].textContent;
                var aDateTime = Date.parse(`${aDate}`);
                var bDateTime = Date.parse(`${bDate}`);
            }
    
    
            //console.log(aDateTime);
            //console.log(bDateTime);
            if(aDateTime < bDateTime){
                return 1;
            }
            if(aDateTime > bDateTime){
                return -1;
            }
    
            return 0;
    
        }).forEach(node=>list.appendChild(node));
    
    
    
    
        //console.log(list);
    
    
    /*------ Nothing but test code and notes below
    
        //var classes = list.children;
        //console.log(classes);
        //sort each list and its elements inside of it
        //console.log(list);
        
        /*
        classes.forEach(function(clas){
            // this is the time
            //console.log(clas.children[1].textContent.split('@'));
            //console.log(clas.children[1].textContent.split('@')[1]);
    
            //gets the date and time to numbers to sort
            var dayOfClass;
            var timeOfClass;
            timeOfClass = convertTime12to24(clas.children[1].textContent.split('@')[1]);
            dayOfClass = clas.children[1].textContent.split('@')[0];
            console.log(Date.parse(`${dayOfClass} ${timeOfClass}`));
    
    
        });
        */
    
        });
    
    }



//this lets us get 
//getColumns[0].children[1].children[0].children[1];


//Next we split the date element using element.split.
//example:  var splitDate = textDate.split('@');
//getColumns[0].children[1].children[0].children[1].textContent.split('@');

//this will pull the date and time into 2 different arrays
//var sortableDates = getColumns[0].children[1].children[0].children[1].textContent.split('@');
//then we use date.parse on the first item in the array to get the value of the date

//split the date and time and fill out the rest of the time into the proper format to put back


//Date.parse(sortableDates[0]);
//example: var testDateTwo = splitDate[0];
//Date.parse(testDateTwo);
//use this value to sort the columns



