# == Utilisation ==
#
# `$ python3 parser.py [files]`
#
# [files]: fichiers respectants l'un des formats décrit ci-dessous
#
# Le résultat est affiché dans le terminal, il peut être redirigé vers un fichier si nécessaire
#
# == Formats des étapes et des achievements ==
#
# ---> fichiers "nodeXXXX.csv"
#
# 01         content
# 02         bg-picture
# 03  <opt>  fg-picture
# 04  <opt>  alcohol-req(min, max)
# 05  <opt>  attendance-req(min, max)
# 06  <opt>  ghost-req(min, max)
# 07  <opt>  is-bar(min, max)
# 08  <opt>  is-baka(min, max)
# 09  <opt>  is-diese(min, max)
# 10  <opt>  likeness-bar(min, max)
# 11  <opt>  likeness-baka(min, max)
# 12  <opt>  likeness-diese(min, max)
# 13  <opt>  modif-alcohol
# 14  <opt>  modif-attendance
# 15  <opt>  modif-ghost
# 16  <opt>  modif-bar
# 17  <opt>  modif-baka
# 18  <opt>  modif-diese
# 19  <opt>  join-bar
# 20  <opt>  join-baka
# 21  <opt>  join-diese
# 22  <opt>  achievement-id
# 23  <opt>  choice-1
# 24  <opt>  choice_1-text
# 25  <opt>  choice-2
# 26  <opt>  choice-2-text
# 27  <opt>  choice-3
# 28  <opt>  choice-3-text
#
# ---> fichiers "achXXX.csv"
#
# 1         achievement-title
# 2         achievement-text
# 3  <opt>  achievement-icon

import sys
import re

ach_fl = re.compile(r'ach(\d+).csv')
node_fl = re.compile(r'node(\d+).csv')
re_req = re.compile(r'\((.*), ?(.*)\)')

NODE_TABLE_SIZE = 28


def handle_str(in_s: str) -> str:
    res = in_s.replace("'", "\\'")
    return f"'{res}'"


def handle_req(req: str) -> str:
    match = re_req.fullmatch(req)
    if match is None:
        return 'NULL'

    min_ = match.group(1)
    try:
        min_ = int(min_)
    except ValueError:
        min_ = 'NULL'
    max_ = match.group(2)
    try:
        max_ = int(max_)
    except ValueError:
        max_ = 'NULL'

    return f'({min_}, {max_})'


def handle_int(poss_int: str) -> str:
    return 0 if poss_int == '' else int(poss_int)


def handle_ach(filename: str):
    match = ach_fl.fullmatch(filename)
    if match is None:
        return None

    with open(filename, 'r', encoding='utf-8') as fl:
        lines = [line.strip().replace('\n', '') for line in fl.readlines()]

    res = dict()
    res['id'] = int(match.group(1))
    res['title'] = handle_str(lines[0])
    res['text'] = handle_str(lines[1])
    try:
        res['icon'] = handle_str(lines[2])
    except IndexError:
        res['icon'] = 'NULL'

    print(f"\n---> Achievement {res['id']} <---")
    print('INSERT INTO "achievements"(id, title, text, icon) VALUES')
    print(f"({res['id']}, {res['title']}, {res['text']}, {res['icon']});")
    print('\n')


def handle_node(filename: str):
    match = node_fl.fullmatch(filename)
    if match is None:
        return None

    current_id = int(match.group(1))

    node_base = re.sub(' +', ' ', 'INSERT INTO "story_node"\
            (id, \
            require_alcohol, \
            require_attendance, \
            require_ghost, \
            is_bar, \
            is_baka, \
            is_diese, \
            likeness_bar, \
            likeness_baka, \
            likeness_diese, \
            modif_alchol, \
            modif_attendance, \
            modif_ghost, \
            modif_bar, \
            modif_baka, \
            modif_diese, \
            join_bar, \
            join_baka, \
            join_diese, \
            ach_id, \
            content, \
            bg_picture, \
            fg_picture, \
            choice_1, \
            choice_2, \
            choice_3) \
            VALUES \
            \n({id}, \
            {req_alcohol}, \
            {req_attendance}, \
            {req_ghost}, \
            {is_bar}, \
            {is_baka}, \
            {is_diese}, \
            {like_bar}, \
            {like_baka}, \
            {like_diese}, \
            {modif_alcohol}, \
            {modif_attendance}, \
            {modif_ghost}, \
            {modif_bar}, \
            {modif_baka}, \
            {modif_diese}, \
            {join_bar}, \
            {join_baka}, \
            {join_diese}, \
            {ach_id}, \
            {content}, \
            {bg_picture}, \
            {fg_picture}, \
            {choice_1}, \
            {choice_2}, \
            {choice_3});')

    choice_base = re.sub(' +', ' ', 'INSERT INTO "choice"\
            (id, \
            content, \
            next) \
            VALUES\
            \n({id}, \
            {content},\
            {next});')

    # Some things are NULL by default, all the others values
    # will always be set
    node_values = {
            'fg_picture': 'NULL',
            'ach_id': 'NULL',
            'choice_1': 'NULL',
            'choice_2': 'NULL',
            'choice_3': 'NULL'
            }

    choices = []

    with open(filename, 'r', encoding='utf-8') as fl:
        lines = [line.strip().replace('\n', '') for line in fl.readlines()]

    # On remplit complètement la liste
    for _ in range(len(lines), NODE_TABLE_SIZE):
        lines.append('')
    # On s'assure que toutes les lignes en plus
    # sont supprimées s'il y en avait
    lines = lines[:NODE_TABLE_SIZE]

    # On commence à remplir
    node_values['id'] = current_id
    node_values['content'] = handle_str(lines[0])
    node_values['bg_picture'] = handle_str(lines[1])

    if lines[2] != '':
        node_values['fg_picture'] = handle_str(lines[2])

    # Requirements
    node_values['req_alcohol'] = handle_req(lines[3])
    node_values['req_attendance'] = handle_req(lines[5])
    node_values['req_ghost'] = handle_req(lines[5])
    node_values['is_bar'] = handle_req(lines[6])
    node_values['is_baka'] = handle_req(lines[7])
    node_values['is_diese'] = handle_req(lines[8])
    node_values['like_bar'] = handle_req(lines[9])
    node_values['like_baka'] = handle_req(lines[10])
    node_values['like_diese'] = handle_req(lines[11])
    # Integers values
    node_values['modif_alcohol'] = handle_int(lines[12])
    node_values['modif_attendance'] = handle_int(lines[13])
    node_values['modif_ghost'] = handle_int(lines[14])
    node_values['modif_bar'] = handle_int(lines[15])
    node_values['modif_baka'] = handle_int(lines[16])
    node_values['modif_diese'] = handle_int(lines[17])
    node_values['join_bar'] = handle_int(lines[18])
    node_values['join_baka'] = handle_int(lines[19])
    node_values['join_diese'] = handle_int(lines[20])
    # Achievement ID if there is one
    if lines[21] != '':
        node_values['ach_id'] = handle_int(lines[21])
    # Choices
    for i in range(1, 4):
        line_i = 20 + i * 2
        if lines[line_i] != '':
            node_values[f'choice_{i}'] = int(lines[line_i])
            res = dict()
            res['id'] = current_id
            res['content'] = handle_str(lines[line_i + 1])
            res['next'] = int(lines[line_i])
            choices.append(res)

    print(f"\n--- Node {current_id} ---")
    print(node_base.format(**node_values))
    for choice in choices:
        print(f"-- ==> {choice['next']}")
        print(choice_base.format(**choice))
    print("\n")


for filename in sys.argv[1:]:
    handle_node(filename)
    handle_ach(filename)
