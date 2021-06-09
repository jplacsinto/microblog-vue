<template>
  <div class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
    <vue-autosuggest
        ref="autocomplete"
        v-model="query"
        :suggestions="suggestions"
        :inputProps="inputProps"
        :sectionConfigs="sectionConfigs"
        :renderSuggestion="renderSuggestion"
        :getSuggestionValue="getSuggestionValue"
        @input="fetchResults" />
  </div>
</template>
w
<script>
    import { VueAutosuggest } from "vue-autosuggest";

    export default {

      data() {
        return {
          query: "",
          results: [],
          timeout: null,
          selected: null,
          debounceMilliseconds: 250,
          usersUrl: "https://microblog-vue.local.com/api/author",
          inputProps: {
            id: "autosuggest__input",
            placeholder: "Looking for someone?",
            class: "form-control",
            name: "hello"
          },
          suggestions: [],
          sectionConfigs: {
            authors: {
              limit: 6,
              label: "Authors",
              onSelected: selected => {
                this.selected = selected.item;
              }
            }
          }
        };
      },
      methods: {
        fetchResults() {
          const query = this.query;

          clearTimeout(this.timeout);
          this.timeout = setTimeout(() => {
            const usersPromise = window.axios.get(this.usersUrl);

            Promise.all([usersPromise]).then(values => {

              this.suggestions = [];
              this.selected = null;

              const users = this.filterResults(values[0].data.data, query, "name");

              users.length &&
                this.suggestions.push({ name: "authors", data: users });

            });
          }, this.debounceMilliseconds);
        },
        filterResults(data, text, field) {
          return data
            .filter(item => {
              if (item[field].toLowerCase().indexOf(text.toLowerCase()) > -1) {
                return item[field];
              }
            })
            .sort();
        },
        renderSuggestion(suggestion) {
          const author = suggestion.item;
          return author.name;
           /* return (
                <div>
                    <img class={{ avatar: true }} src={{author.avatar} />
                    {author.name}
                </div>
                );*/
        },
        getSuggestionValue(suggestion) {
          let { name, item } = suggestion;
          return item.name;
        }
      }
    };
</script>

<style>

.avatar {
  height: 25px;
  width: 25px;
  border-radius: 20px;
  margin-right: 10px;
}
#autosuggest__input {
  outline: none;
  position: relative;
  display: block;
  border: 1px solid #616161;
  padding: 10px;
  width: 100%;
  box-sizing: border-box;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
}

#autosuggest__input.autosuggest__input-open {
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}

.autosuggest__results-container {
  position: relative;
  width: 100%;
}

.autosuggest__results {
  font-weight: 300;
  margin: 0;
  position: absolute;
  z-index: 10000001;
  width: 100%;
  border: 1px solid #e0e0e0;
  border-bottom-left-radius: 4px;
  border-bottom-right-radius: 4px;
  background: white;
  padding: 0px;
  max-height: 400px;
  overflow-y: scroll;
}

.autosuggest__results ul {
  list-style: none;
  padding-left: 0;
  margin: 0;
}

.autosuggest__results .autosuggest__results-item {
  cursor: pointer;
  padding: 15px;
}

#autosuggest ul:nth-child(1) > .autosuggest__results_title {
  border-top: none;
}

.autosuggest__results .autosuggest__results-before {
  color: gray;
  font-size: 11px;
  margin-left: 0;
  padding: 15px 13px 5px;
  border-top: 1px solid lightgray;
}

.autosuggest__results .autosuggest__results-item:active,
.autosuggest__results .autosuggest__results-item:hover,
.autosuggest__results .autosuggest__results-item:focus,
.autosuggest__results
  .autosuggest__results-item.autosuggest__results-item--highlighted {
  background-color: #f6f6f6;
}
</style>