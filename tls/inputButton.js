var counter=0;
console.log(counter);
function addInput() {
    counter += 1;
    var input ='<div id="newItem'+counter+'">\
    <label for="itemName">Item Name</label>\
    <label for="itemType">Item Type</label> &nbsp;<br>\
        <input type="text" name="itemName" >\
        <input type="text" name="itemType" ><br>\
    <label for="itemSize">Item Size</label>\
    <label for="qty">Qty.</label><br>\
        <input type="text" name="itemSize" >\
        <input type="text" name="qty" ><br>\
    <label for="declaredValue">Declared Value</label>\
        <input type="text" name="declaredValue" d> <br>\
</div>';



    var newItem = document.getElementById("newItem0");
    newItem.innerHTML += input;
}

function removeInput() {
    const elem = document.getElementById("newItem0");
    elem.removeChild(elem.lastChild);
    counter -= 1;
}