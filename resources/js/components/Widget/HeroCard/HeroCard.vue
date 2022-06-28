<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="container">
          <div class="row g-2 align-items-center">
            <AnchorButton :btnTxt="'Member List'" :To="'all-customer'" />
            <AnchorButton :btnTxt="'Agent List'" :To="'agents'" />
            <AnchorButton :btnTxt="'Plan List'" :To="'plan'" />
            <AnchorButton :btnTxt="'Location List'" :To="'location'" />
            <AnchorButton :btnTxt="'Transaction List'" :To="'reports'" />
            <AnchorButton :btnTxt="'Complement'" />
            <AnchorButton :btnTxt="'Scheme List'" :To="'scheme'" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <div class="empty">
              <div class="empty-img">
                <img
                  class="w-100 h-100"
                  :src="HeroImage"
                  alt=""
                  height="100%"
                  width="100%"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import HeroImage from "../../../src/assets/heroimage/hero.jpg";
import AnchorButton from "../../Buttons/AnchorButton/AnchorButton.vue";
export default {
  setup() {
    return { HeroImage };
  },
  components: { AnchorButton },
};
</script>

<style>
</style>
