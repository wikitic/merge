<template>
  <v-container
    fill-height
  >
    <v-layout
      justify-center
      align-center
    >
      <v-flex 
        shrink
      >
        <Metas />
        <div
          class="text-xs-center"
        >
          <div class="logo">
            <span class="wiki">Wiki</span>
            <span class="tic">TIC</span>
          </div>
          <h1 
            class="display-2 font-weight-thin"
          >
            Proyecto educativo de <strong>código abierto</strong> para fomentar el uso de las TIC en los niveles de ESO y Bachiller.
          </h1>
          <TagList
            class="ma-5 hidden-sm-and-down"
          />
        </div>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import Metas from '@/components/Layout/Metas'
import TagList from '@/components/Tag/List'

export default {
  components: {
    Metas,
    TagList
  }
}
</script>

<style lang="scss" scoped>
.logo {
  margin-bottom: 50px;
  .wiki {
    display: inline-block;
    padding: 0 15px;
    background: #2d2d2d;
    color: #fff;
    font-size: 60px;
    font-weight: 600;
    line-height: 70px;
  }
  .tic {
    color: #333;
    font-size: 42px;
    font-weight: 300;
  }
}
</style>
