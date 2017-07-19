function populateSelect() {

    //array to hold options
    var langArray = [
        {value: "AL", text: "Alabama"},
        {value: "AK", text: "Alaska"},
        {value: "AZ", text: "Arizona"},
        {value: "AR", text: "Arkansas"},
        {value: "CA", text: "California"},
        {value: "CO", text: "Colorado"},
        {value: "CT", text: "Connecticut"},
        {value: "DE", text: "Delaware"},
        {value: "FL", text: "Florida"},
        {value: "GA", text: "Georgia"},
        {value: "HI", text: "Hawaii"},
        {value: "ID", text: "Idaho"},
        {value: "IL", text: "Illinois"},
        {value: "IN", text: "Indiana"},
        {value: "IA", text: "Iowa"},
        {value: "KS", text: "Kansas"},
        {value: "KY", text: "Kentucky"},
        {value: "LA", text: "Louisiana"},
        {value: "ME", text: "Maine"},
        {value: "MD", text: "Maryland"},
        {value: "MA", text: "Massachusetts"},
        {value: "MI", text: "Michigan"},
        {value: "MN", text: "Minnesota"},
        {value: "MS", text: "Mississippi"},
        {value: "MO", text: "Missouri"},
        {value: "MT", text: "Montana"},
        {value: "NE", text: "Nebraska"},
        {value: "NV", text: "Nevada"},
        {value: "NH", text: "New Hampshire"},
        {value: "NJ", text: "New Jersey"},
        {value: "NM", text: "New Mexico"},
        {value: "NY", text: "New York"},
        {value: "NC", text: "North Carolina"},
        {value: "ND", text: "North Dakota"},
        {value: "OH", text: "Ohio"},
        {value: "OK", text: "Oklahoma"},
        {value: "OR", text: "Oregon"},
        {value: "PA", text: "Pennsylvania"},
        {value: "RI", text: "Rhode Island"},
        {value: "SC", text: "South Carolina"},
        {value: "SD", text: "South Dakota"},
        {value: "TN", text: "Tennessee"},
        {value: "TX", text: "Texas"},
        {value: "UT", text: "Utah"},
        {value: "VT", text: "Vermont"},
        {value: "VA", text: "Virginia"},
        {value: "WA", text: "Washington"},
        {value: "WV", text: "West Virginia"},
        {value: "WI", text: "Wisconsin"},
        {value: "WY", text: "Wyoming"},
    ];

    var getState = document.getElementById('state'),
    newState = document.getElementById('newState'),
    createState = document.getElementById('create-state'),
    option,
    i = 0,
    il = langArray.length;

    //handle getState
    for (; i < il; i += 1) {
        option = document.createElement('option');
        option.setAttribute('value', langArray[i].value);
        option.appendChild(document.createTextNode(langArray[i].text));
        getState.appendChild(option);
    }

    i=0;

    //handle newState
    for (; i < il; i += 1) {
        option = document.createElement('option');
        option.setAttribute('value', langArray[i].value);
        option.appendChild(document.createTextNode(langArray[i].text));
        newState.appendChild(option);
    }

    i=0;

    //handle createState
    for (; i < il; i += 1) {
        option = document.createElement('option');
        option.setAttribute('value', langArray[i].value);
        option.appendChild(document.createTextNode(langArray[i].text));
        createState.appendChild(option);
    }
}//end function