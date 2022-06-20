<template>
  <div class="col-sm-6 col-lg-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="subheader">{{ heading }}</div>
          <div class="ms-auto lh-1"></div>
        </div>
        <div class="h1 mb-3">{{ total }}</div>
        <div class="d-flex mb-2">
          <div>{{ secondHeading }}</div>
        </div>
        <div class="progress progress-sm">
          <div
            :class="`progress-bar bg-${color}`"
            :style="`width: ${total}%`"
            role="progressbar"
            :aria-valuenow="total"
            aria-valuemin="0"
            aria-valuemax="100"
            aria-label="75% Complete"
          >
            <span class="visually-hidden">{{ total }}% Complete</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
 props:{
     heading:String,
     secondHeading:String,
     color:String,
     total:Number
 }

};
</script>

<style lang="scss" scoped></style>
