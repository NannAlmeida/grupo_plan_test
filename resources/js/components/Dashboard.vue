<template>
  <div id="dashboard">
    <b-container class="d-flex justify-content-center align-items-center vh-100">
      <b-card class="text-center" style="max-width: 800px; width: 100%">
        <h1>Progresso dos funcionários</h1>
        <b-button variant="danger" @click="logout"><b-spinner v-if="loading" small type="border"></b-spinner>
            {{ loading ? "Saindo..." : "Sair" }}</b-button</b-button>
        <b-card-body>
          <b-table :items="employees" :fields="fields" bordered hover striped>
            <template v-slot:cell(progress)="data">
              <b-progress
                :value="data.item.progress"
                :max="100"
                :variant="getBadgeVariant(data.item.progress)"
              >
              </b-progress>
            </template>
            <template #cell(status)="data">
              <b-badge :variant="getStatusBadgeVariant(data.item.status)">
                {{ data.item.status }}
              </b-badge>
            </template>
          </b-table>
        </b-card-body>
      </b-card>
    </b-container>
  </div>
</template>

<script>
export default {
  name: "Dashboard",
  data() {
    return {
      employees: [],
      fields: [
        { key: "name", label: "Nome" },
        { key: "training", label: "Treinamento" },
        { key: "status", label: "Status" },
        { key: "progress", label: "Progresso" },
      ],
      loading: false
    };
  },
  methods: {
    logout() {
      this.loading = !this.loading;
      setTimeout(() => {
        localStorage.removeItem("authToken");
        this.$router.push({ name: "login" });
      }, 100);
    },
    async fetchEmployeeTrainings() {
      try {
        const token = localStorage.getItem('authToken');

        const response = await fetch("/api/trainings", {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${token}`
          },
        });

        if (response.ok) {
          const data = await response.json();

          let trainings = [];

          data.map((training) => {
            training.users.map((user) =>
              trainings.push({
                name: user.name,
                training: training.name,
                status: user.pivot.status === 'I' ? 'Não iniciado' : user.pivot.status === 'A' ? 'Em andamento' : 'Concluído',
                progress: user.pivot.progress,
              })
            );
          });

          this.employees = trainings;
        }
      } catch (error) {
        console.log(error);
      }
    },
    getBadgeVariant(progress) {
      if (progress == 0) {
        return "secondary";
      } else if (progress > 0 && progress < 100) {
        return "primary";
      } else if (progress == 100) {
        return "success";
      }
    },
    getStatusBadgeVariant(status) {
      switch (status) {
        case 'Não iniciado':
          return "danger";
        case 'Em andamento':
          return "info";
        case 'Concluído':
          return "success";
      }
    },
  },

  created() {
    this.fetchEmployeeTrainings();
  },
};
</script>

<style scoped>
#dashboard {
  width: 100vw;
  height: 100vh;
  background: #e9faff;
}
</style>
