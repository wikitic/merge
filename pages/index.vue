<template>
  <main class="index">
    <Metas />
    <b-container class="d-flex h-100">
      <b-row align-v="center">
        <b-col class="v-100">
          <div class="logo">
            <span class="wiki">Wiki</span>
            <span class="tic">TIC</span>
          </div>
          <p class="lead">
            Proyecto educativo de <strong>código abierto</strong> para fomentar el uso de las TIC en los niveles de ESO y Bachiller.
          </p>
          <hr>
          <p class="italic">
            Más proyectos de la <strong>Asociación Programo Ergo Sum</strong>.
          </p>
          <div>
            <b-link href="https://www.programoergosum.com" target="_blank" rel="noopener noreferrer">
              <img src="logo-programoergosum.png" alt="Programo Ergo Sum">
            </b-link>
            <b-link href="https://www.aprendeprogramando.es" target="_blank" rel="noopener noreferrer">
              <img src="logo-aprendeprogramando.png" alt="Aprende Programando">
            </b-link>
          </div>
        </b-col>
      </b-row>
    </b-container>
  </main>
</template>

<script>
import Metas from '@/components/Layout/Metas'

export default {
  components: {
    Metas
  }
}
</script>

<style lang="scss" scoped>
.index {
  height: -webkit-calc(100vh - 65px);
  height: -moz-calc(100vh - 65px);
  height: calc(100vh - 65px);
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
  hr {
    margin-top: 75px;
    padding-top: 75px;
    border-top: 1px solid #f0f0f0;
  }
  .italic {
    font-style: italic;
  }
  img {
    max-width: 230px;
    margin: 0 15px;
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
      font-size: 35px;
    }
  }
}
</style>
