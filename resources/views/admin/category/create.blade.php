@extends('layouts.client')
@section('css')
<style>
    li[data-id] {
        cursor: pointer;
    }

    ul {
        padding-inline-start: 20px;
    }
</style>
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <form id="categoryForm">
                <div class="form-group">
                    <label for="categoryName">Category Name</label>
                    <input type="text" class="form-control" id="categoryName" name="categoryName"
                        aria-describedby="categoryName" placeholder="Enter Category Name">
                    <small id="categoryHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="categoryParent">Parent</label>
                    <select name="categoryParent" id="categoryParent" class="form-control">
                        <option value="0" selected>Main Category</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col">
            <div id="categorylist"></div>
        </div>
    </div>
</div>

@section('script')
<script>
    class Category {
        constructor(name, parent) {
            this.name = name;
            this.id = Category.incrementId();
            this.parent = parent;
        }
        static incrementId() {
            if (!this.latestId) this.latestId = 1
            else this.latestId++
            return this.latestId
        }

    }

    class CategoryList {
        constructor() {
            this.categories = [];
        }

        add(categoryName, parent = 0) {
            this.categories.push(new Category(categoryName, parent));
        }

        crateList(categories = [], parent = 0) {
            var html = "<ul>";
            categories.forEach((item) => {
                if (parent == item.parent) {
                    html += `<li data-id='${item.id}'>` + item.name;
                    html += this.crateList(categories, item.id);
                    html += "</li>";
                }
            });
            html += "</ul>";
            return html;
        }
        getlist() {
            return this.crateList(this.categories)
        }
    }

    var list = new CategoryList();
    list.add("php");
    list.add("composer", 1);
    list.add("laravel", 2);
    list.add("Javascript");
    list.add("Jquery", 4);

    const categorylist = document.querySelector("#categorylist");
    const categoryParent = document.querySelector("#categoryParent");
    const categoryForm = document.querySelector("#categoryForm");



    const {
        categories
    } = list;

    function addOption() {
        categoryParent.length = 1;
        categories.forEach((item) => {
            let option = document.createElement("option");
            option.value = item.id;
            option.text = item.name;
            categoryParent.add(option);
        });
    }



    // form Submited
    categoryForm.addEventListener("submit", (event) => {
        event.preventDefault();
        let inputs = event.target.elements;
        if (inputs["categoryName"].value) {
            list.add(inputs["categoryName"].value, inputs["categoryParent"].value);
            categorylist.innerHTML = list.getlist();
            listClick();
            addOption();
            inputs["categoryName"].value = "";
        }
    });


    window.addEventListener('load', (event) => {
        addOption();
        categorylist.innerHTML = list.getlist();
        listClick();
    });

    function listClick() {
        const clist = Array.from(document.querySelectorAll("li[data-id]"));

        clist.forEach((item) => {
            item.addEventListener("click", (e) => {
                categoryParent.selectedIndex = e.target.getAttribute("data-id");
            });
        })
    }

    //save to storage
    // if exist in localStorage categories
    if (localStorage.categories) {
        var localCategories = JSON.parse(localStorage.categories);
        console.log(localCategories);

    } else {
        localStorage.categories = JSON.stringify(list);
    }
</script>
@endsection
@endsection
