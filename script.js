function go2Page()
{
    var limiti = document.getElementById("limiti").value;
    window.location.href = 'test.php?page=1&limiti='+limiti+'#fokusi';
}

function appearDetails(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("shfaqu") == -1) {
        x.className += " shfaqu";
    } else {
        x.className = x.className.replace(" shfaqu", "");
    }
}

function menuDropdown() {
    document.getElementById("menuDropdown").classList.toggle("show");
}

function ShowElements() {
    document.getElementById("ShowElements").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
