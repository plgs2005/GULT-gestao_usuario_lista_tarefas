<template>
  <div>
    <headerSite></headerSite>

    <router-view></router-view>

    <footerSite></footerSite>
  </div>
</template>

<script>
import SiteFooterComponent from './SiteFooterComponent'
import SiteHeaderComponent from './SiteHeaderComponent'
export default {
    components:{
        footerSite: SiteFooterComponent,
        headerSite:SiteHeaderComponent,
    }
    
}
</script>