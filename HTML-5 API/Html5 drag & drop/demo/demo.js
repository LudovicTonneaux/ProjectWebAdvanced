/**
 * Created by Jordy Swinnen on 19/05/2017.
 */
var start = function(e) {
    e.dataTransfer.effectAllowed = 'move';
    e.dataTransfer.setData('iconId', e.target.id);
    e.dataTransfer.setDragImage(e.target, 0, 0);
    return true;
}

var enter = function(e) {
    return true;
}

var over = function(e) {
    var iconId = e.dataTransfer.getData('iconId');
    var targetId = e.target.id;

    if (targetId.indexOf('icon') > -1) {
        return true;
    }

    return false;
}

var drop = function(e) {
    var iconId = e.dataTransfer.getData('iconId');
    var icon = document.getElementById(iconId);
    e.target.appendChild(icon);
    e.stopPropagation();
    return false;
}

var end = function(e) {
    e.dataTransfer.clearData('iconId');
    return true;
}

var pollResults = function() {
    var score = document.getElementById('score');
    score.innerHTML = 0;

    var hitboxes = document.getElementById('dropzone-holder').children;

    for (var i = 0; i < hitboxes.length; ++i) {
        var hitbox = hitboxes[i];
        var dropzone = hitbox.lastElementChild;

        if (dropzone.children.length > 0) {
            dropzone.style.backgroundSize = '0';

            var dropzoneId = dropzone.id;
            var iconId = dropzone.firstElementChild.id;

            var dropzoneName = dropzoneId.substring(dropzoneId.indexOf('-') + 1);
            var iconName = iconId.substring(iconId.indexOf('-') + 1);

            dropzone.previousElementSibling.setAttribute('class', 'answer show');

            if (iconName == dropzoneName) {
                dropzone.previousElementSibling.src = 'img/right.png';
                score.innerHTML = parseInt(score.innerHTML) + 1;
            } else {
                dropzone.previousElementSibling.src = 'img/wrong.png';
            }
        } else {
            dropzone.previousElementSibling.setAttribute('class', 'answer hide');
            dropzone.style.backgroundSize = '100% auto';
        }
    }

    if (parseInt(score.innerHTML) == 12) {
        alert('Game complete!\nClick OK to reload.');
        location.reload();
    }
}

setInterval(pollResults, 50);

var shuffleIcons = function() {
    var dropzoneContainer = document.getElementById('dropzone-container');
    var icons = dropzoneContainer.children;
    var fragment = document.createDocumentFragment();
    while (icons.length) {
        fragment.appendChild(icons[Math.floor(Math.random() * icons.length)]);
    }
    dropzoneContainer.appendChild(fragment);
}

var shuffleDropzones = function() {
    var dropzoneHolder = document.getElementById('dropzone-holder');
    var dropzones = dropzoneHolder.children;
    var fragment = document.createDocumentFragment();
    while (dropzones.length) {
        fragment.appendChild(dropzones[Math.floor(Math.random() * dropzones.length)]);
    }
    dropzoneHolder.appendChild(fragment);
}

window.onload = function() {
    shuffleIcons();
    shuffleDropzones();
}

function shuffle(){
    shuffleIcons()
    shuffleDropzones()
}