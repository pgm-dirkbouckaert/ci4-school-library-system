<script>
  (() => {
    const app = {
      init() {
        this.cacheElements();
        this.registerListeners();
        this.baseUrl = <?= json_encode($baseUrl) ?>;
      },
      cacheElements() {
        this.modalId = "#modal-delete";
        this.modalDelete = document.getElementById("modal-delete");
        this.modalBody = document.getElementById("modal-body");
        this.formDelete = document.getElementById("form-delete");
      },
      registerListeners() {
        // Listen for delete buttons
        const buttons = document.querySelectorAll(".btn-delete");
        for (const btn of buttons) {
          btn.addEventListener("click", (e) => {
            // Get collection id and name
            const memberId = e.currentTarget.dataset.memberId;
            const memberName = e.currentTarget.dataset.memberName;
            // Add html to body of modal
            this.modalBody.innerHTML = `<p>Ben je zeker dat je de account van <span class="fw-bold text-danger">${memberName} (ID: ${memberId})</span> wil verwijderen?</p>`;
            // Add action to form
            this.formDelete.action = `${this.baseUrl}/members/delete/${memberId}`;
            // Show modal
            const modalDelete = new bootstrap.Modal(this.modalId);
            modalDelete.show();
          })
        }
      }
    };
    app.init();
  })();
</script>