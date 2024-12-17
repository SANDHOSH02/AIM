

    function openMaleModal() {
        var maleModal = document.getElementById("maleModal");
        maleModal.style.display = "block";
    }

    function closeMaleModal() {
        var maleModal = document.getElementById("maleModal");
        maleModal.style.display = "none";
    }

    var submitMaleButton = document.getElementById("submitMaleComplaint");
    submitMaleButton.onclick = function() {
        // Handle form submission here
        // ...
        
        // Show the "Next Card" button and hide the form
        document.getElementById("maleForm").style.display = "none";
        document.getElementById("nextCardContainer").style.display = "block";
    }

    var nextCardButton = document.getElementById("nextCardButton");
    nextCardButton.onclick = function() {
        closeMaleModal(); // Close the current modal
        // Open the next card modal (if it exists)
        // Example: openFemaleModal(); for the next card
    }

    var submitMaleButton = document.getElementById("submitMaleComplaint");
    submitMaleButton.onclick = function() {
    // Handle form submission here
    // ...
    
    // Close the current modal
    closeMaleModal();
    
    // Show the "grievancesModal" modal
    var grievancesModal = document.getElementById("grievancesModal");
    grievancesModal.style.display = "block";
}

    var closeGrievancesButton = document.getElementById("closeGrievancesModal");
    closeGrievancesModalcloseGrievancesButton.onclick = function() {
    var grievancesModal = document.getElementById("grievancesModal");
    grievancesModal.style.display = "none";
}

    var submitGrievancesButton = document.getElementById("submitGrievancesComplaint");
    submitGrievancesButton.onclick = function() {
    // Handle form submission here
    // ...
    
    // Close the current modal
    closeGrievancesModal();
    
    // Open the next card modal (if it exists)
    // Example: openNextModal(); for the next card
}
    document.getElementById("closeGrievancesModal").addEventListener("click", function() {
    var grievancesModal = document.getElementById("grievancesModal");
    grievancesModal.style.display = "none";
});

function openMaleModal() {
    var maleModal = document.getElementById("maleModal");
    maleModal.style.display = "block";
}

function closeMaleModal() {
    var maleModal = document.getElementById("maleModal");
    maleModal.style.display = "none";
}

var submitMaleButton = document.getElementById("submitMaleComplaint");
submitMaleButton.onclick = function() {
    // Handle form submission here
    // ...
    
    // Show the "Next Card" button and hide the form
    document.getElementById("maleForm").style.display = "none";
    document.getElementById("nextCardContainer").style.display = "block";
}

var nextCardButton = document.getElementById("nextCardButton");
nextCardButton.onclick = function() {
    closeMaleModal(); // Close the current modal
    // Open the next card modal (if it exists)
    // Example: openFemaleModal(); for the next card
}

var submitMaleButton = document.getElementById("submitMaleComplaint");
submitMaleButton.onclick = function() {
    document.getElementById("maleForm").submit(); // Submit the form
}
