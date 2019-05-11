<template>
  <main class="index">
    <b-container class="d-flex h-100">
      <b-row align-v="center">
        <b-col class="v-100">
          <div class="logo">
            <span class="wiki">Wiki</span>
            <span class="tic">TIC</span>
          </div>
          <p class="lead">
            Proyecto educativo de <strong>código abierto</strong> para fomentar el uso de las <abbr title="Tecnologías de la Información y Comunicación">TIC</abbr> en los niveles de ESO y Bachiller.
          </p>
          <p class="italic">
            Otro proyeco más de la
            <b-link href="https://www.programoergosum.com" target="_blank">
              Asociación Programo Ergo Sum
            </b-link>.
          </p>
        </b-col>
      </b-row>
    </b-container>
  </main>
</template>

<script>
export default {
  head() {
    return {
      title: 'Wiki TIC - Asociación Programo Ergo Sum'
    }
  }
}
</script>

<style lang="scss" scoped>
.index {
  height: 80vh;
  text-align: center;
  .logo {
    margin-bottom: 40px;
    .wiki {
      display: inline-block;
      padding: 0 15px;
      background: #2d2d2d;
      color: #fff;
      font-size: 70px;
      font-weight: 600;
      line-height: 90px;
    }
    .tic {
      color: #333;
      font-size: 50px;
      font-weight: 300;
    }
  }
  .lead {
    padding: 0 50px;
    font-size: 40px;
    line-height: 1.5;
    strong {
      font-weight: 600;
    }
  }
  .italic {
    margin-top: 50px;
    font-style: italic;
  }
}
@media (max-width: 1300px) {
  .index {
    .logo {
      .wiki {
        font-size: 40px;
      }
      .tic {
        font-size: 20px;
      }
    }
    .lead {
      font-size: 25px;
    }
  }
}
</style>
