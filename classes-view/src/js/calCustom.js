$(function () {
	 setTimeout(function(){
       
            let pastDates = true, availableDates = false, availableWeekDays = false
            
            let calendar = new VanillaCalendar({
                selector: "#myCalendar",
                months: ["Januart", "Frbruary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                shortWeekday: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                onSelect: (data, elem) => {
                    console.log(data, elem)
                }
            })
            
		},1);
});
	