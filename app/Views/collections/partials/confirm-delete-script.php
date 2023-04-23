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
            const collectionId = e.currentTarget.dataset.collectionId;
            const collectionName = e.currentTarget.dataset.collectionName;
            // Add html to body of modal
            this.modalBody.innerHTML = `<p>Ben je zeker dat je de collectie <span class="fw-bold text-danger">${collectionName}</span> wil verwijderen?</p>`;
            // Add action to form
            this.formDelete.action = `${this.baseUrl}/collections/delete/${collectionId}`;
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