<template>
  <v-list>
    <template v-for="item in navigation">
      <v-list-tile :key="item.link" :to="item.link">
        <v-list-tile-action>
          <v-icon v-text="item.icon" />
        </v-list-tile-action>
        <v-list-tile-title v-text="item.title" />
      </v-list-tile>
      <v-list-tile v-for="subitem in item.items" :key="subitem.title" :to="subitem.link">
        <v-list-tile-action>
          <v-icon />
        </v-list-tile-action>
        <v-list-tile-title v-text="subitem.title" />
      </v-list-tile>
      <v-divider :key="item.title" />
    </template>
  </v-list>
</template>

<script>
export default {
  name: 'Navigation',
  data: () => ({
    navigation: [
      {
        title: 'Proyecto',
        icon: 'dashboard',
        link: '/proyecto'
      },
      {
        title: 'Tutoriales',
        icon: 'folder',
        link: '/tag',
        items: [
          { title: 'Raspberry Pi', link: '/tag/raspberry+pi' },
          { title: 'Microbit', link: '/tag/microbit' },
          { title: 'ESP8266', link: '/tag/esp8266' }
        ]
      }
    ]
  })
}
</script>

<style lang="scss" scope>
</style>
