function loadProjects() {
    fetch('http://localhost/portfolio/get_projects.php')
    .then(response => response.json())
    .then(data => {
        let list = document.getElementById('projectsList');
        list.innerHTML = ''; 
        if(data.length === 0) {
            list.innerHTML = '<p class="text-muted ms-3">No projects found. Add one to start!</p>';
            return;
        }
        data.forEach(project => {
            list.innerHTML += `
                <div class="col-md-6 mb-4">
                    <div class="card project-card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="text-primary fw-bold mb-1">${project.title}</h5>
                            <p class="text-muted small mb-2">By: <strong>${project.owner_name}</strong></p>
                            <div class="mb-2"><span class="badge-tech">${project.technology_used}</span></div>
                            <p class="small text-secondary border-top pt-2">${project.description}</p>
                            <div class="mt-3 small border-top pt-2 text-muted">
                                <i class="bi bi-envelope-fill text-primary"></i> ${project.owner_email} <br>
                                <i class="bi bi-telephone-fill text-primary"></i> ${project.owner_phone}
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
    })
    .catch(error => console.error("Database connection error:", error));
}

document.getElementById('projectForm').addEventListener('submit', function(e) {
    e.preventDefault(); 
    let formData = new FormData(this);
    fetch('http://localhost/portfolio/add_project.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            this.reset(); 
            loadProjects(); 
        } else {
            alert("Error: " + data.message);
        }
    });
});

loadProjects();