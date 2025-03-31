document.addEventListener("DOMContentLoaded", function () {
    let form = document.querySelector(".cpsr-container form");

    if (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent page reload

            let career = document.getElementById("cpsr-career").value;
            let skillsContainer = document.querySelector(".cpsr-skill-list");

            // Clear previous results
            if (skillsContainer) {
                skillsContainer.remove();
            }

            // Fetch skills dynamically (mocked for now)
            let skills = {
                web_developer: ["HTML", "CSS", "JavaScript", "PHP", "MySQL"],
                data_scientist: ["Python", "R", "Machine Learning", "Statistics", "SQL"],
                graphic_designer: ["Photoshop", "Illustrator", "UI/UX", "Sketch", "Figma"]
            };

            // Create new results container
            let newSkillsContainer = document.createElement("div");
            newSkillsContainer.classList.add("cpsr-skill-list");

            if (skills[career]) {
                let skillList = "<h3>Recommended Skills:</h3><ul>";
                skills[career].forEach(skill => {
                    skillList += `<li>${skill}</li>`;
                });
                skillList += "</ul>";
                newSkillsContainer.innerHTML = skillList;
            } else {
                newSkillsContainer.innerHTML = "<p>No skills found for this career path.</p>";
            }

            form.parentNode.appendChild(newSkillsContainer);
        });
    }
});
