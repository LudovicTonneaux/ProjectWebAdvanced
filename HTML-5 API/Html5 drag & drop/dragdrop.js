/**
 * Created by swinn on 03/05/2017.
 */

var sourceElement = null;

/**
 * This event is fired when a draggable element is dragged.
 **/
function dragstart(e)
{
    e.dataTransfer.effectAllowed = "move";
    e.dataTransfer.setData("text/plain", this.src);
    sourceElement = this;
    console.log("Dragging Started");
}
document.getElementById("img1").addEventListener("dragstart", dragstart, false);
document.getElementById("img2").addEventListener("dragstart", dragstart, false);

/**
 * This event is fired every time the mouse is moved while the object is being dragged.
 **/
function drag()
{
    console.log("Dragging");
}
document.getElementById("img1").addEventListener("drag", drag, false);
document.getElementById("img2").addEventListener("drag", drag, false);

/**
 * This event is fired when the user releases the mouse button while dragging an element.
 **/
function dragend(e)
{
    console.log("Dragging ended");
}
document.getElementById("img1").addEventListener("dragend", dragend, false);
document.getElementById("img2").addEventListener("dragend", dragend, false);

/**
 * This event is fired when the mouse is moved over the target element while a drag is occurring.
 **/
function dragenter()
{
    console.log("Dragged element enters droping zone");
}
document.getElementById("img1").addEventListener("dragenter", dragenter, false);
document.getElementById("img2").addEventListener("dragenter", dragenter, false);

/**
 * This event is fired whenever the mouse is inside the target zone while dragging an element.
 * The listener attached to the target element should indicate weather a drop is allowed or not.
 * If there is no listeners or else if listener is not preventing the the browser default action then drop is not allowed by default
 **/
function dragover(e)
{
    e.preventDefault(); ////default browser action is not to make any element a dropable zone. We are preventing the default action for this element to make it a droppable zone.
    e.dataTransfer.dropEffect = "move";
    console.log("Dragged element enters droping zone");
}
document.getElementById("img1").addEventListener("dragover", dragover, false);
document.getElementById("img2").addEventListener("dragover", dragover, false);

/**
 * This event is fired when the mouse is moved out of the target element while a drag is occurring.
 **/
function dragleave()
{
    console.log("Dragged element left target zone");
}
document.getElementById("img1").addEventListener("dragleave", dragleave, false);
document.getElementById("img2").addEventListener("dragleave", dragleave, false);

/**
 * This event is fired when the mouse button is released while moving on the target element.
 **/
function drop(e)
{
    e.stopPropagation();////browsers usually redirect after drop event. I don't know why? Its beffer to stop it by stopping bubbling of the event to the browser window.
    var url = this.src;
    this.src = e.dataTransfer.getData("text/plain");
    sourceElement.src = url;
    console.log("Dragged element dropped on target");
}
document.getElementById("img1").addEventListener("drop", drop, false);
document.getElementById("img2").addEventListener("drop", drop, false);