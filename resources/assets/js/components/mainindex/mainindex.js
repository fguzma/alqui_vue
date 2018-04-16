import Media from './media.json'

export default {
  name: 'HelloWorld',
  data() {
    return {
      msg: 'Vue tutorial!',
      slide: 0,
      sliding: null,
      center: {lat: 12.122527, lng: -86.237792},
      markers: [{
        position: {lat: 12.122527, lng: -86.237792}
      }, ],
      Media
    };
  },
  methods: {
    onSlideStart(slide) {
      this.sliding = true
    },
    onSlideEnd(slide) {
      this.sliding = false
    },
    showModal () {
      this.$root.$emit('bv::show::modal', '')
    },
    hideModal () {
      this.$root.$emit('bv::hide::modal', '')
    }
  },
  mounted() {
    let sticky = false; // Declare this variable when is not down.
    const email = 'j.romeroc97@gmail.com';
    const descriptionDiv = $('#description');

    function stickNavigation(){
      descriptionDiv.addClass('fixed').removeClass('absolute'); // Fixing div description
      descriptionDiv.removeClass('text-center');
      $('#navigation').slideUp('fast');
      $('#sticky-navigation').slideDown('fast');
    }

    function unStickNavigation() {
      descriptionDiv.removeClass('fixed').addClass('absolute');
      descriptionDiv.addClass('text-center');
      $('#navigation').slideDown('fast');
      $('#sticky-navigation').slideUp('fast');
    }

    function sendForm() {
      $.ajax({
        url: $form.attr('action'),
        method: 'POST',
        data: $form.formObject(),
        dataType: 'json',
        success: () => {
          alert('Everything Ok!');
        }
      });
    }

    function isInBottom() {
      const description = $('#description');
      const descriptionHeight = description.height();
      return $(window).scrollTop() > $(window).height() - (descriptionHeight * 2)
    }

    $('#form-contact').on('submit', (ev) => {
      ev.preventDefault();
      sendForm($(this));
      return false
    });

    /* Define time interval */

    $(window).scroll(()=>{
      const inBottom = isInBottom();
      // If in bottom and sticky is false
      if(inBottom && !sticky){
        // Change sticky to true
        sticky = true;
        stickNavigation();
      }
      if(!inBottom && sticky){
        sticky = false;
        unStickNavigation();
      }
    });

    // Call to modal bootstrap

    $('#alquiler-sillas').on('click', ()=>{
      this.$root.$emit('bv::show::modal', 'modal1')
    });

    $('#bodas').on('click', ()=>{
      this.$root.$emit('bv::show::modal', 'modal2')
    });
  }
};
